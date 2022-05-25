import React, {useState} from 'react';
import {Outlet} from 'react-router-dom';
import {Flash} from '../Flash';
import Status from '../Components/Status'
import Menu from '../Components/Menu';

const Layout = () => {

    const [activeStatus, setActiveStatus] = useState(true);

    return (
        <>
            <Flash />

            <div className="columns_wrap">

                <section className="column side_nav">
                    <div className="status">
                        <Status setActiveStatus={setActiveStatus} activeStatus={activeStatus} />
                    </div>

                    <Menu />

                </section>
                <section className="column content">
                    <div className="input_box">

                       <Outlet context={[activeStatus]} />

                    </div>
                </section>
            </div>
        </>
    );
};

export default Layout;
