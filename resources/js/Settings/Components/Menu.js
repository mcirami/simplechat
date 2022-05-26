import React from 'react';
import { Link } from 'react-router-dom';
import {BiLink, BiNotepad, BiBot, BiImages} from 'react-icons/bi';
import {ImProfile} from 'react-icons/im';
import {IoWomanOutline} from 'react-icons/io5';

const Menu = () => {

    return (
        <ul>
            <li>
                <Link to='/settings'>
                    <span>
                        <BiNotepad />
                    </span>
                    Script
                </Link>
            </li>
            <li>
                <Link to='keywords'>
                    <span>
                        <BiBot />
                    </span>
                    Keywords
                </Link>
            </li>
            <li>
                <Link to='links'>
                    <span>
                        <BiLink />
                    </span>
                    Links
                </Link>
            </li>
            <li>
                <Link to='pictures'>
                    <span>
                        <BiImages />
                    </span>
                    Pictures
                </Link>
            </li>
            <li>
                <Link to='model-info'>
                    <span>
                        <IoWomanOutline />
                    </span>
                    Model Info
                </Link>
            </li>
            {/*<li>
                <Link to='keepalive'>Keep-Alive</Link>
            </li>*/}
            <li className="nav_link">
                <Link to='edit-profile'>
                    <span>
                        <ImProfile />
                    </span>
                    Lander Content
                </Link>
            </li>
        </ul>
    );
};

export default Menu;
