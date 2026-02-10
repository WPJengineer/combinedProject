import { useEffect, useState } from "react";
import './Timer.css';

function formatMMSS(seconds) {
  const m = Math.floor(seconds / 60);
  const s = seconds % 60;
  return `${String(m)}:${String(s).padStart(2, "0")}`;
}

export default function Timer({ isRunning, restartKey, onFinish }) {
  const [timeLeft, setTimeLeft] = useState(60);

  // Reset to 1:00 when barajar is clicked
  useEffect(() => {
    if (isRunning) {
      setTimeLeft(60);
    }
  }, [restartKey, isRunning]);

  // Countdown ONLY when running
  useEffect(() => {
    if (!isRunning) return;

    if (timeLeft <= 0) {
      onFinish?.();
      return;
    }

    const interval = setInterval(() => {
      setTimeLeft((t) => t - 1);
    }, 1000);

    return () => clearInterval(interval);
  }, [isRunning, timeLeft, onFinish]);

  return (
    <div className="timer">
      <p>Tiempo restante:</p>
      <p id="clock">{formatMMSS(timeLeft)}</p>
    </div>
  );
}