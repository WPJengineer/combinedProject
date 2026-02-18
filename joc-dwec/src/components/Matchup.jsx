import './Matchup.css';

export default function Matchup({ carta }) {
  return (
    <div className="matchup-card">
      <img src={carta.src} alt={carta.type} />
    </div>
  );
}