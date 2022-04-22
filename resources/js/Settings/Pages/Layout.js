import React from 'react';
import {Outlet} from 'react-router-dom';
import {Flash} from '../Flash';

import Menu from '../Components/Menu';

const Layout = () => {

    return (
        <>
            <Flash />
            <div className="columns_wrap">
                <section className="column side_nav">

                    <Menu />

                </section>
                <section className="column content">
                    <div className="input_box">

                       <Outlet />

                    </div>
                </section>
            </div>
        </>
    );
};

export default Layout;
