import React from 'react';
import ReactDOM from 'react-dom';
import BottomSlider from './BottomSlider';

if (document.getElementById('bottom_slider')) {

    ReactDOM.render(
        <React.StrictMode>
            <BottomSlider />
        </React.StrictMode>,
        document.getElementById('bottom_slider'));

}
