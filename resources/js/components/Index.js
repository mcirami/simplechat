import React from 'react';
import ReactDOM from 'react-dom';
import Chat from './Chat';

if (document.getElementById('chat')) {

    ReactDOM.render(
        <React.StrictMode>
            <Chat />
        </React.StrictMode>,
        document.getElementById('chat'));

}
