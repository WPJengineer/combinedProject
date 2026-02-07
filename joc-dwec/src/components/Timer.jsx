import { useEffect, useState } from "react";

function formatMMSS(seconds) {
  const m = Math.floor(seconds / 60);
  const s = seconds % 60;
  return `${String(m).padStart(2, "0")}:${String(s).padStart(2, "0")}`;
}

export default function Timer({ isRunning, restartKey, onFinish }) {
  const [timeLeft, setTimeLeft] = useState(120);

  // Reset to 2:00 when barajar is clicked
  useEffect(() => {
    if (isRunning) {
      setTimeLeft(120);
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
      <p>Time remaining</p>
      <p>{formatMMSS(timeLeft)}</p>
    </div>
  );
}