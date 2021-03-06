export const getImages = (sliderPosition) => {

    const r = sliderPosition === "top" ?  require.context('/images/slider-bottom', false, /\.(png|jpe?g|svg)$/) : require.context('/images/slider-bottom', false, /\.(png|jpe?g|svg)$/);

    let images = [];
    r.keys().map((item, index) => {
        images[index] = item.replace('./', '');
    });
    return images;
}

export const slideOptions = () => {
    return {
        type  : 'loop',
        gap   : '1rem',
        perMove  : 1,
        perPage : 3,
        speed  : 1000,
        interval : 4000,
        autoplay : true,
        //height: '200px',
        //autoHeight: true,
        heightRatio: .28,
        drag: true,
        //cover: true,
        pagination: false,
    }
}
