import React, {useEffect, useState} from 'react';
import Pusher from 'pusher-js';
import axios from 'axios';

const Chat = () => {

    const [username, setUsername] = useState('username');
    const [messages, setMessages] = useState([]);
    const [message, setMessage] = useState('')
    let allMessages = [];

    useEffect(() => {
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        const pusher = new Pusher('1ae4bd9595a6c0f1c9a6', {
            cluster: 'us2'
        });

        const channel = pusher.subscribe('chat');
        channel.bind('message', function(data) {
            console.log(data);

            allMessages.push(data);
            setMessages(allMessages);
        });
    }, []);

    const handleSubmit = async e => {
        e.preventDefault();

        const packets = {
            username: username,
            message: message
        }
        axios.post('http://localhost:8081/api/messages', packets)
        .then((response) => {
            console.log(response);

            setMessage('');
        }).catch((error) => {
            console.log(error);
        })

        /*try {
         let result = await fetch('http://localhost:8081/api/messages', {
                method: 'POST',
                headers: {'Content-Type': 'application/JSON'},
                body: JSON.stringify({
                    username,
                    message
                })
            });

            console.log(result);

        } catch (error) {
            console.log(error)
        }*/

       /* const object = {
            username: username,
            message: message
        }

        allMessages.push(object);
        setMessages(allMessages);*/
        setMessage('');
    }

    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="d-flex flex-column align-items-stretch flex-shrink-0 bg-white">
                            <div className="list-group list-group-flush border-bottom scrollarea">
                                <div className="d-flex align-items-center flex-shrink-0 p-3 lin-dark text-decoration-none border-bottom">
                                    <input className="fs-5" placeholder="username" type="text"
                                           onChange={e => setUsername(e.target.value)}
                                    />
                                </div>
                                <div className="list-group-item list-group-item-action py-3 lh-tight message_section">
                                    {messages.map((message, index) => {
                                        return (
                                            <div key={index}>
                                                <div className="d-flex w-100 align-items-center justify-content-between">
                                                    <strong className="mb-1">{message.username}</strong>
                                                </div>
                                                <div className="col-10 mb-1 small">{message.message}</div>
                                            </div>
                                        )
                                    })}
                                </div>
                            </div>
                        </div>
                        <form onSubmit={event => handleSubmit(event)}>
                            <input type="text" className="form-control" placeholder="Write a message" value={message}
                                onChange={e => setMessage(e.target.value)}
                            />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Chat;
