import axios from 'axios';

export const saveSetting = async (packets) => {

    try {
        const response = await axios.post('/store-setting', packets);
        return response.data;
    } catch (err) {
        console.error(err);
    }

}

export const getSetting = async (packets) => {

    const script = await axios.post('/get-setting', packets);

    return script["data"];
}
