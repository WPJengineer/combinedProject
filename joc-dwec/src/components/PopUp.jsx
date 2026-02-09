import { useEffect } from 'react'
import './PopUp.css'

export default function PopUp({ resultGame }) {

  const [showResult, setShowResult] = useState(false);

  useEffect(() => {
    if (resultGame) {
      return;
    } else {
      setShowResult(true);
    }
  }, [resultGame])

  return (
    <div>

    </div>
  )
}
