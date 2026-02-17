import { useEffect, useState } from 'react'
import './App.css'
import Carta from './components/Carta';
import Timer from './components/Timer';
import PopUp from './components/PopUp';
import Matchup from './components/Matchup';

function App() {

  const [cartas, setCartas] = useState([]);
  const [eleccionUno, setEleccionUno] = useState(null);
  const [eleccionDos, setEleccionDos] = useState(null);
  const [deshabilitado, setDeshabilitado] = useState(false);
  const [isRunning, setIsRunning] = useState(false);
  const [restartKey, setRestartKey] = useState(0);
  // 'idle' before start, 'playing' after shuffle, then 'win' or 'lose'
  const [gameStatus, setGameStatus] = useState('idle');

  // need to get this from our assets.
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

  const barajar = () => {
    // resets all states
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
    const pickCard = [...imagenesCartas]
      .sort(() => Math.random() - 0.5)
      .slice(0, 1)
      .map((c) => ({ ...c}));
    console.log(pickCard);
    setCartas(pickCard);
  }

  // when we have a picked card we capture the weakness.


  // when we pick a type we capture the type to check if its in the weakness array.
  // if in we show correct if not a fail in pop up-

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
          isRunning={isRunning}
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
      <div className="picked-card">
        {
          cartas.map((carta) => {
            <Matchup
              carta={carta}
              key={carta.id}
          />
          })
        }
      </div>
      <PopUp
        gameStatus={gameStatus}
        onClose={() => setGameStatus('idle')}
        onRestart={barajar}
      />
    </div>
  )
}

export default App
