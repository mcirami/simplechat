import React from 'react';
import ReactDOM from 'react-dom';
import AddUser from './components/AddUser';

if (document.getElementById('add_user')) {

    ReactDOM.render(
        <React.StrictMode>
            <AddUser />
        </React.StrictMode>,
        document.getElementById('add_user'));

}
