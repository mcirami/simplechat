import React from 'react';
import { Link } from 'react-router-dom';

const Menu = () => {

    return (
        <ul>
            <li>
                <Link to='/settings'>Script</Link>
            </li>
            <li>
                <Link to='keywords'>Keywords</Link>
            </li>
            <li>
                <Link to='links'>Links</Link>
            </li>
            <li>
                <Link to='pictures'>Pictures</Link>
            </li>
            {/*<li>
                <Link to='keepalive'>Keep-Alive</Link>
            </li>*/}
        </ul>
    );
};

export default Menu;
