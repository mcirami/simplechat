import React, {useEffect, useState} from 'react';
import {addUser, addUserToDOM} from '../Services/ChatRequests';

const AddUser = () => {

    const [userName, setUserName] = useState(null);

    const handleSubmit = (e) => {

        const packets = {
            userName: userName
        }
        addUser(packets)
        .then((data) => {
            if (data.success) {
                console.log(data);
                addUserToDOM(data.user);
            }
        });
    }

    console.log(userName);

    return (
        <div className="row">
            <div className="col-9">
                <input className="w-100" type="text" placeholder="User"
                       onChange={(e) => setUserName(e.target.value)}
                       onKeyPress={ event => {
                           if(event.key === 'Enter') {
                               handleSubmit(event);
                           }
                       }}
                       onBlur={(e) => handleSubmit(e)}
                />
            </div>
            <div className="col-3">
                <a href="#">+ Add User</a>
            </div>
        </div>
    )
}

export default AddUser;
