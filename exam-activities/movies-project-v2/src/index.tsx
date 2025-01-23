import React from 'react';
import ReactDOM from 'react-dom/client';
import './Styles/Theme.css';
import reportWebVitals from './reportWebVitals';
import MoviesApp from './Components/MoviesApp';

const root = ReactDOM.createRoot(
  document.getElementById('root') as HTMLElement
);
root.render(
  //<React.StrictMode>
    <MoviesApp />
  //</React.StrictMode>
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
