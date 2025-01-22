import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './index.css'
import Page from './app/dashboard/page'
// import App from './App.tsx'

createRoot(document.getElementById('root')!).render(
  <StrictMode>
    <Page/>
  </StrictMode>,
)
