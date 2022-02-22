

export const getImages = (sliderPosition) => {

    const r = sliderPosition === "top" ?  require.context('/images/slider-top', false, /\.(png|jpe?g|svg)$/) : require.context('/images/slider-bottom', false, /\.(png|jpe?g|svg)$/);

    let images = [];
    r.keys().map((item, index) => {
        images[index] = item.replace('./', '');
        console.log( item.replace('./', ''))
    });
    return images;
}
