import React from 'react';
import ReactDOM from 'react-dom';
import App from './App';

if (document.getElementById('settings')) {

    ReactDOM.render(
        <React.StrictMode>
            <App />
        </React.StrictMode>,
        document.getElementById('settings'));

}
