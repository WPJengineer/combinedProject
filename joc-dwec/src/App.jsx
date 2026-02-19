import { useEffect, useState } from 'react'
import './App.css'
import Carta from './components/Carta';
import Timer from './components/Timer';
import PopUp from './components/PopUp';
import Matchup from './components/Matchup';

function App() {

  const [cartas, setCartas] = useState([]);
  const [pickedCard, setPickedCard] = useState(null);
  const [selectedType, setSelectedType] = useState("");
  const [resultMessage, setResultMessage] = useState("");
  const [mode, setMode] = useState(null);
  const [eleccionUno, setEleccionUno] = useState(null);
  const [eleccionDos, setEleccionDos] = useState(null);
  const [deshabilitado, setDeshabilitado] = useState(false);
  const [isRunning, setIsRunning] = useState(false);
  const [restartKey, setRestartKey] = useState(0);
  const [gameStatus, setGameStatus] = useState('idle');

  const imagenesCartas = [
    { "src": "/img/bug.png", "encontrada": false, "type": "bug", "weakness": ["flying", "fire", "rock"] },
    { "src": "/img/dark.png", "encontrada": false, "type": "dark", "weakness": ["fighting", "fairy", "bug"] },
    { "src": "/img/dragon.png", "encontrada": false, "type": "dragon", "weakness": ["dragon", "fairy", "ice"] },
    { "src": "/img/electric.png", "encontrada": false, "type": "electric", "weakness": ["ground"] },
    { "src": "/img/fairy.png", "encontrada": false, "type": "fairy", "weakness": ["steel", "poison"] },
    { "src": "/img/fighting.png", "encontrada": false, "type": "fighting", "weakness": ["flying", "psychic", "fairy"] },
    { "src": "/img/fire.png", "encontrada": false, "type": "fire", "weakness": ["water", "rock", "ground"] },
    { "src": "/img/flying.png", "encontrada": false, "type": "flying", "weakness": ["electric", "ice", "rock"] },
    { "src": "/img/ghost.png", "encontrada": false, "type": "ghost", "weakness": ["ghost", "dark"] },
    { "src": "/img/grass.png", "encontrada": false, "type": "grass", "weakness": ["flying", "ice", "poison", "bug", "fire"] },
    { "src": "/img/ground.png", "encontrada": false, "type": "ground", "weakness": ["water", "grass", "ice"] },
    { "src": "/img/ice.png", "encontrada": false, "type": "ice", "weakness": ["fighting", "steel", "rock", "fire"] },
    { "src": "/img/normal.png", "encontrada": false, "type": "normal", "weakness": ["fighting"] },
    { "src": "/img/poison.png", "encontrada": false, "type": "poison", "weakness": ["ground", "psychic"] },
    { "src": "/img/psychic.png", "encontrada": false, "type": "psychic", "weakness": ["dark", "ghost", "bug"] },
    { "src": "/img/rock.png", "encontrada": false, "type": "rock", "weakness": ["steel", "fighting", "water", "grass", "ground"] },
    { "src": "/img/steel.png", "encontrada": false, "type": "steel", "weakness": ["fire", "ground", "fighting"] },
    { "src": "/img/water.png", "encontrada": false, "type": "water", "weakness": ["grass", "electric"] }
    // { "src": "/img/stellar.png", "encontrada": false, "type": "stellar", "weakness": [""] }
  ];

  const allTypes = imagenesCartas.map(c => c.type);

  const barajar = () => {
    // sets mode and resets other game.
    setMode('memory');
    setPickedCard(null);

    // resets all states.
    setEleccionUno(null);
    setEleccionDos(null);
    setDeshabilitado(false);

    // picks out 15 pairs of our array that can contain more than 15 total.
    const seleccion = [...imagenesCartas]
      .sort(() => Math.random() - 0.5)
      .slice(0, 15)
      .map((c) => ({ ...c, encontrada: false }));

    //randomises their positions in the grid.
    const cartasBarajadas = [...seleccion, ...seleccion]
      .sort(() => Math.random() -0.5)
      .map((carta) => ({...carta, id: Math.random()}));

    setCartas(cartasBarajadas);
    setIsRunning(true);
    setGameStatus('playing');
    setRestartKey((k) => k + 1);
  };

  // shuffle cards and pick one out of the deck for the match up game.
  const shuffle = () => {
    // sets mode and resets other.
    setMode('matchup');
    setCartas([]);
    setSelectedType("");
    setResultMessage("");

    // stop timer.
    setIsRunning(false);

    const randomIndex = Math.floor(Math.random() * imagenesCartas.length);
    const pick = { ...imagenesCartas[randomIndex], encontrada: false, id: Math.floor(Math.random() * 19) };
    setPickedCard(pick);
    // console.log(pick);
  }

  // get weakness of selected random card.
  const checkAnswer = () => {
    if (!selectedType || !pickedCard) return;
    if (pickedCard.weakness.includes(selectedType)) {
      setResultMessage("Correcto!");
    } else {
      setResultMessage("Incorrecto!");
    }
  };

  const handleEleccion = (carta) => {
    eleccionUno ? setEleccionDos(carta) : setEleccionUno(carta);
  }

  useEffect(() => {
    if (eleccionUno && eleccionDos) {
      setDeshabilitado(true);
      if (eleccionDos.src === eleccionUno.src) {
        setCartas(cartasPrevias => {
          return cartasPrevias.map((carta) => {
            if (carta.src === eleccionUno.src) {
              return {...carta, "encontrada": true};
            } else {
              return carta;
            }
          });
        });
        resetear();
      } else {
        setTimeout(()=>resetear(), 1000);
      }
    }
  }, [eleccionUno, eleccionDos]);

  const resetear = () => {
    setEleccionUno(null);
    setEleccionDos(null);
    setDeshabilitado(false);
  }

  // checks to see if we have found all the pairs so we can call the pop-up component.
  useEffect(() => {
    if (gameStatus !== 'playing') return;
    if (cartas.length === 0) return;

    const allFound = cartas.every((c) => c.encontrada === true);
    if (allFound) {
      setGameStatus('win');
      setIsRunning(false);
    }
  }, [cartas, gameStatus]);

  return (
    <div className="App">
      <h1 className="title">PAREJAS OCULTAS</h1>
      <div>
        <Timer
          isRunning={mode === 'memory' && isRunning}
          restartKey={restartKey}
          onFinish={() => {
            setIsRunning(false);
            setGameStatus((prev) => (prev === 'win' ? 'win' : 'lose'));
          }}
        />
      </div>
      <div>
        <button onClick={barajar}>Jugar Memory game</button>
        <button onClick={shuffle}>Jugar Match Up game</button>
      </div>
      {mode === 'memory' && (
        <div className="grid-carta">
          {
            cartas.map((carta) => (
              <Carta
                carta={carta}
                key={carta.id}
                handleEleccion={handleEleccion}
                volteada={carta===eleccionUno || carta===eleccionDos || carta.encontrada}
                deshabilitado={deshabilitado || gameStatus !== 'playing'}
              />
            ))
          }
        </div>
      )}
      {mode === 'matchup' && pickedCard && (
        <div className="picked-card">
          <Matchup carta={pickedCard} />
          <div className="matchup-select">
            <select
              value={selectedType}
              onChange={(e) => setSelectedType(e.target.value)}
            >
              <option value="">Select a type</option>
              {allTypes.map(type => (
                <option key={type} value={type}>{type}</option>
              ))}
            </select>
            <button onClick={checkAnswer}>Check</button>
          </div>
          {resultMessage && (
            <div className="matchup-result">{resultMessage}</div>
          )}
        </div>
      )}
      <PopUp
        gameStatus={gameStatus}
        onClose={() => setGameStatus('idle')}
        onRestart={barajar}
      />
    </div>
  )
}

export default App
