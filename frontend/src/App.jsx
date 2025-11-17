import { useEffect, useState } from 'react'
import './App.css'

const API_URL =
  import.meta.env.VITE_API_URL ||
  'https://umb-web-taller-ch14.onrender.com/api/tasks'

function App() {
  const [tasks, setTasks] = useState([])
  const [title, setTitle] = useState('')
  const [loading, setLoading] = useState(false)
  const [error, setError] = useState('')

  useEffect(() => {
    const loadTasks = async () => {
      setLoading(true)
      setError('')
      try {
        const res = await fetch(API_URL)
        if (!res.ok) throw new Error('No se pudo obtener las tareas')
        const data = await res.json()
        setTasks(data)
      } catch (err) {
        setError(err.message)
      } finally {
        setLoading(false)
      }
    }

    loadTasks()
  }, [])

  const handleSubmit = async (event) => {
    event.preventDefault()
    if (!title.trim()) return
    setError('')
    try {
      const res = await fetch(API_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ titulo: title.trim() })
      })
      if (!res.ok) throw new Error('No se pudo crear la tarea')
      const newTask = await res.json()
      setTasks((prev) => [newTask, ...prev])
      setTitle('')
    } catch (err) {
      setError(err.message)
    }
  }

  return (
    <main className="app">
      <h1>Lista de tareas</h1>
      <form className="task-form" onSubmit={handleSubmit}>
        <input
          type="text"
          placeholder="Escribe una tarea"
          value={title}
          onChange={(event) => setTitle(event.target.value)}
        />
        <button type="submit">Agregar</button>
      </form>

      {loading && <p>Cargando...</p>}
      {error && <p className="error">{error}</p>}

      <ul className="task-list">
        {tasks.map((task) => (
          <li key={task.id}>
            <span className={task.completada ? 'done' : ''}>
              {task.titulo}
            </span>
          </li>
        ))}
      </ul>
    </main>
  )
}

export default App
