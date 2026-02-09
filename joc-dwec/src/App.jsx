import { useEffect, useState } from 'react'
import './App.css'
import Carta from './components/Carta';
import Timer from './components/Timer';

function App() {

  const [cartas, setCartas] = useState([]);
  // const [turnos, setTurnos] = useState(0);
  const [eleccionUno, setEleccionUno] = useState(null);
  const [eleccionDos, setEleccionDos] = useState(null);
  const [deshabilitado, setDeshabilitado] = useState(false);
  const [isRunning, setIsRunning] = useState(false);
  const [restartKey, setRestartKey] = useState(0);

  // need to get this from our assets.
  const imagenesCartas = [
    { "src": "/img/bug.png", "encontrada": false },
    { "src": "/img/dark.png", "encontrada": false  },
    { "src": "/img/dragon.png", "encontrada": false  },
    { "src": "/img/electric.png", "encontrada": false  },
    { "src": "/img/fairy.png", "encontrada": false  },
    { "src": "/img/fighting.png", "encontrada": false  },
    { "src": "/img/fire.png", "encontrada": false  },
    { "src": "/img/flying.png", "encontrada": false  },
    { "src": "/img/ghost.png", "encontrada": false  },
    { "src": "/img/grass.png", "encontrada": false  },
    { "src": "/img/ground.png", "encontrada": false  },
    { "src": "/img/ice.png", "encontrada": false  },
    { "src": "/img/normal.png", "encontrada": false  },
    { "src": "/img/poison.png", "encontrada": false  },
    { "src": "/img/psychic.png", "encontrada": false  },
    { "src": "/img/rock.png", "encontrada": false  },
    { "src": "/img/steel.png", "encontrada": false  },
    { "src": "/img/water.png", "encontrada": false  },
    { "src": "/img/stellar.png", "encontrada": false  }
  ];

  const barajar = () => {
    // picks out 15 pairs of our array that can contain more than 15 total.
    const seleccion = [...imagenesCartas]
    .sort(() => Math.random() - 0.5)
    .slice(0, 15);

    //randomises their positions in the grid.
    const cartasBarajadas = [...seleccion, ...seleccion]
      .sort(() => Math.random() -0.5)
      .map((carta) => ({...carta, id: Math.random()}))

    setCartas(cartasBarajadas);
    setIsRunning(true);
    setRestartKey((k) => k + 1);
  };

  const handleEleccion = (carta) => {
    console.log(carta);
    eleccionUno ? setEleccionDos(carta) : setEleccionUno(carta);
  }

  // console.log(cartas);

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

  console.log(cartas);

  const resetear = () => {
    setEleccionUno(null);
    setEleccionDos(null);
    setDeshabilitado(false);
  }

  return (
    <div className="App">
      <h1 class="title">MEMORY APP</h1>
      <div>
        <Timer
        isRunning={isRunning}
        restartKey={restartKey}
        onFinish={() => {
          setIsRunning(false);
          // show pop up saying we lost.
        }} />
      </div>
      <button onClick={barajar}>Nueva Partida</button>

      <div className="grid-carta">
        {
          cartas.map((carta) => (
            <Carta
              carta={carta}
              key={carta.id}
              handleEleccion={handleEleccion}
              volteada={carta===eleccionUno || carta===eleccionDos || carta.encontrada}
              deshabilitado={deshabilitado}
            />
          ))
        }
      </div>
        

    </div>
  )
}

export default App
