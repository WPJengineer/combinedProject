import { useEffect, useState } from 'react'
import './App.css'
import Carta from './components/Carta';

function App() {

  const [cartas, setCartas] = useState([]);
  const [turnos, setTurnos] = useState(0);
  const [eleccionUno, setEleccionUno] = useState(null);
  const [eleccionDos, setEleccionDos] = useState(null);
  const [deshabilitado, setDeshabilitado] = useState(false);

  const imagenesCartas = [
    { "src": "/img/white.png", "encontrada": false },
    { "src": "/img/orange.png", "encontrada": false  },
    { "src": "/img/grey.png", "encontrada": false  },
    { "src": "/img/black.png", "encontrada": false  },
    { "src": "/img/green.png", "encontrada": false  },
    { "src": "/img/hat.png", "encontrada": false  }
  ];

  const barajar = () => {
    const cartasBarajadas = [...imagenesCartas, ...imagenesCartas]
      .sort(() => Math.random() -0.5)
      .map((carta) => ({...carta, id: Math.random()}))

    setCartas(cartasBarajadas);
    setTurnos(0);
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
    setTurnos(turnosPrevios => turnosPrevios + 1);
    setDeshabilitado(false);
  }

  return (
    <div className="App">
      <h1>Memory App</h1>
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
        <div><p>Turno: {turnos}</p></div>

    </div>
  )
}

export default App
