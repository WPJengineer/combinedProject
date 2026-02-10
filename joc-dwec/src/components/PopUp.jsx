import { useEffect, useState } from 'react'
import './PopUp.css'

export default function PopUp({ gameStatus, onClose, onRestart }) {

  const [showResult, setShowResult] = useState(false);

  useEffect(() => {
    setShowResult(gameStatus === 'win' || gameStatus === 'lose');
  }, [gameStatus]);

  if (!showResult) return null;

  const isWin = gameStatus === 'win';

  return (
    <div className="popup-overlay">
      <div className="popup">
        <h2>{isWin ? '¡Has ganado!' : 'Has perdido'}</h2>
        <div className="popup-actions">
          <button onClick={onRestart}>Jugar de nuevo</button>
          <button onClick={onClose}>Cerrar</button>
        </div>
      </div>
    </div>
  )
}