import axios from 'axios';
import React from 'react';
import ReactDOM from 'react-dom';

export const addUser = (packets) => {

    return axios.post('add-user/', packets)
        .then(
            (response) => {
                const user = response.data.user;
                return {
                    success: true,
                    user: user[0]
                }

            })
        .catch(error => {
        if (error.response) {
            //EventBus.dispatch("error", { message: error.response.data.errors.add_user[0] });
            console.log(error.response);
            return {
                success: false,
            }

        } else {
            console.log("ERROR:: ", error);
        }
    });
}

export const addUserToDOM = (user) => {

    console.log(user.avatar);
    const tableRow = document.querySelector('.search-records');

    const pTag = React.createElement("p", {datatype: "user", dataid: user.id}, user.name);
    const tdDiv = React.createElement("div", {className: "avatar av-m"/*style: {backgroundImage: + 'avatar.png'}*/ }, "")
    const td1 = React.createElement('td', {}, tdDiv);
    const td2 = React.createElement('td', {}, pTag);
    const tr = React.createElement("tr", {dataaction: 0}, td1,td2);
    const tbody = React.createElement("tbody", {}, tr);
    const content = React.createElement("table", {className: "messenger-list-item", datacontact:user.id}, tbody)
    ReactDOM.render(content, tableRow);
    //tableRow.after(tag);

}

export default addUser;
