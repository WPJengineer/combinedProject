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
      setTimeLeft(60);
  }, [restartKey]);

  // Countdown ONLY when running
  useEffect(() => {
    if (!isRunning) return;

    const interval = setInterval(() => {
      setTimeLeft((t) => {
        if (t <= 1) {
          clearInterval(interval);
          onFinish?.();
          return 0;
        }
        return t - 1;
      });
    }, 1000);

    return () => clearInterval(interval);
  }, [isRunning, timeLeft, onFinish]);

  const lowTime = timeLeft <= 10;

  return (
    <div className="timer">
      <p>Tiempo restante:</p>
      <p id="clock"
        className={lowTime ? "danger" : ""} >
        {formatMMSS(timeLeft)}
      </p>
    </div>
  );
}