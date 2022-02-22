import React from 'react';
import ReactDOM from 'react-dom';
import TopSlider from './TopSlider';

if (document.getElementById('top_slider')) {

    ReactDOM.render(
        <React.StrictMode>
            <TopSlider />
        </React.StrictMode>,
        document.getElementById('top_slider'));

}
