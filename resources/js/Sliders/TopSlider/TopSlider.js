import React, {useEffect, useState} from 'react';
import { Splide, SplideSlide } from '@splidejs/react-splide';
import '@splidejs/splide/dist/css/splide.min.css';
import {getImages} from '../Utilities/GetSlides';

const TopSlider = () => {

    const [images, setImages] = useState(getImages('top'))

    return (

        <div className="slide_wrapper">
            <Splide options={ {
                type  : 'loop',
                gap   : '1rem',
                perMove  : 1,
                perPage : 3,
                speed  : 500,
                interval : 2000,
                autoplay : true,
                height: '200px',
                drag: true,
                pagination: false,
            } }
                hasSliderWrapper
            >
                {images.map((image, index) => {
                     return (
                         <SplideSlide key={index}>
                             <div className="content_wrap">
                                 <img src={'./images/slider-top/' + image} alt=""/>
                                 <p>{image.replace('.jpg', '')}</p>
                             </div>

                         </SplideSlide>
                     )
                })

                }
            </Splide>
        </div>

    )
}

export default TopSlider;
