import { useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'

import Menu from './components/menu/Menu'


function App() {
  const [count, setCount] = useState(0)

  return (
    <div className="App">
      <Menu />
    </div>
  )
}

export default App
