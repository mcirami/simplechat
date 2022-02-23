import React, {useEffect, useState} from 'react';
import { Splide, SplideSlide } from '@splidejs/react-splide';
import '@splidejs/splide/dist/css/splide.min.css';
import {getImages, slideOptions} from '../Utilities/SlideRequests';

const TopSlider = () => {

    const [images, setImages] = useState(getImages('top'))
    const [mySlideOptions, setMySlideOptions] = useState(slideOptions());

    return (

        <div className="slide_wrapper">
            <Splide options={ mySlideOptions }
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
