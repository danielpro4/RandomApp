import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import Speaker from './Speaker';
import moment from 'moment';

import Tabs from './Tabs';
import Tab from './Tab';
import ParticipantItem from './ParticipantItem';

import axios from 'axios';

export default class MainView extends Component {

    constructor(props) {
        super(props);

        // Bind Events
        this.handleStopClick = this.handleStopClick.bind(this);
        this.handleRunClick = this.handleRunClick.bind(this);
        this.handleTaskChange = this.handleTaskChange.bind(this);
        this.handleAddKeyPress = this.handleAddKeyPress.bind(this);
        this.handleAddChange = this.handleAddChange.bind(this);
        this.handleAddSubmit = this.handleAddSubmit.bind(this);
        this.handleRemoveClick = this.handleRemoveClick.bind(this);
        this.handleSyncClick = this.handleSyncClick.bind(this);

        this.speaker = new Speaker();
        this.speaker.completed.add(() => {

            setTimeout(() => {
                // Update XP for the winner participant or the challenge
                axios.post(`/api/challenges`, {
                    task: this.state.taskName,
                    participant_id: this.state.participantid
                }).then((response) => {

                    if (response.data) {
                        // Clear view
                        this.setState({
                            counter: 0,
                            progress: 0,
                            message: '[Participante Seleccionado]',
                            participantid: 0
                        });

                        this.loadUsers();
                    }
                }).catch((error) => {
                    console.error(error);
                });

            }, 1000);

        });

        // Init state
        this.state = {
            participants: [],
            participantid: 0,
            errors: [],
            taskName: `Poner el café`,
            message: 'Participante Seleccionado',
            counter: 0,
            active: false,
            progress: 0,
            newName: ''
        };
    }

    handleSyncClick(evt) {
        this.cancelEvent(evt);

        this.refs.loading.showModal();

        this.loadUsers(() => {
            this.refs.loading.close();
        });

    }

    handleRemoveClick(evt, id) {
        this.cancelEvent(evt);

        axios.delete(`/api/participants/${id}`)
            .then((response) => {

                if (response) {
                    this.loadUsers();
                }
            })
            .catch((error) => {
                console.log(error);
            });
    }

    clearText (text) {
        let t = text.toLowerCase();

        t = t.normalize('NFD').replace(/[\u0300-\u036f]/g,"");

        return t.replace(/\s/ig, '.');
    }


    handleAddSubmit(evt) {
        this.cancelEvent(evt);

        if (String(this.state.newName).length < 3) return false;

        let firstname = this.state.newName;
        let email = this.clearText(firstname) + '@' + 'gmail.com';
        let user_id = 1;
        let newParticipant = {firstname, email, user_id};

        this.createParticipant(newParticipant, (response) => {

            if (response.data) {
                this.setState((prevState) => ({
                    newName: ''
                }));

                this.loadUsers();
            }
        });
    }

    handleAddKeyPress(evt) {

    }

    handleAddChange(evt) {
        let  newName = evt.target.value;

        this.setState({ newName });
    }

    cancelEvent(event) {
        if (event.preventDefault) {
            event.preventDefault();
        }

        if (event.stopPropagation) {
            event.stopPropagation();
        }
    }

    getRandom(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);

        return Math.floor(Math.random() * (max - min)) + min
    }

    handleStopClick(evt) {
        this.cancelEvent(evt);
    }

    handleRunClick(evt) {
        this.cancelEvent(evt);

        if (String(this.state.taskName).length < 3) {
            this.refs.txtTaskName.focus();
            return false;
        }

        if (this.state.participants.length < 0) {
            return false;
        }

        // Recursive func
        let fn = () => {
            let rand = this.getRandom(0, this.state.participants.length);
            let participant = this.state.participants[rand];

            this.setState((prevState) => ({
                counter: prevState.counter + 1
            }));

            if (this.state.counter <= this.props.times) {

                setTimeout(() => {
                    fn()
                }, this.props.speed);

                let delta = Number(this.state.counter) * 100 / Number(this.props.times);

                this.setState({
                    message: participant.name,
                    progress: delta
                });

            } else {

                let message = `${participant.name} te toca ${this.state.taskName}`;
                let participantid = participant.id;

                this.setState({message, participantid});

                this.speaker.speak(message);
            }
        };

        fn();
    }

    handleTaskChange(evt) {
        this.cancelEvent(evt);

        this.setState({
            taskName: evt.target.value
        });
    }

    loadUsers(cb) {

        axios.get('/api/participants')
            .then((response) => {
                let participants = response.data.participants;

                this.setState({ participants });

                if (cb) {
                    cb();
                }
            })
            .catch((error) => {
                console.log(error);
            });
    }

    createParticipant(participant, cb) {

        let errors = [];

        axios.post('/api/participants', participant)
            .then((response) => {

                if (response) {
                    cb(response);
                }
            })
            .catch((error) => {

                for (let e in error.response.data.errors) {
                    errors.push(error.response.data.errors[e][0]);
                }

                if (errors.length > 0) {

                    this.setState({errors});

                    setTimeout(() => {
                        this.setState({errors: []});
                        this.refs.dialogView.close();
                    }, 3000 * 1);

                    this.refs.dialogView.showModal();
                }
            });
    }

    componentWillMount() {
        // TODO - console.log('1.http://random.dev/api/participants')

    }

    componentDidMount() {
        // TODO
        this. loadUsers();
    }

    render() {
        return (
            <div className="random-app">
                <header className="header">
                    <div className="header-row">
                        <div className="header-row__title">{this.props.title}</div>
                        <div className="header-row__sync" onClick={this.handleSyncClick}>
                            <span className="lnr lnr-sync"></span>
                        </div>
                    </div>
                </header>
                <main className="main">
                    <Tabs defaultActiveTabIndex="0">
                        <Tab tabName="Inicio" iconClassName={'lnr-clock'} linkClassName={''}>
                            <div className="random-view">
                                <form className="form-view">
                                    <div className="form-view-row">
                                        <label htmlFor="txtTaskName" className="form-label">Tarea: </label>
                                        <input id="txtTaskName"
                                               classID="txtTaskName"
                                               ref="txtTaskName"
                                               className="form-control"
                                               placeholder="Nombre de la tarea"
                                               value={this.state.taskName}
                                               type="text"
                                               onChange={this.handleTaskChange}/>
                                    </div>
                                </form>

                                <div className="display-view">
                                    <div className="message">{this.state.message}</div>
                                    <div className="counter">{this.state.counter == 0 ? '0 %' : this.state.progress + ' %' }</div>
                                    <progress className="progress" value={this.state.progress} max="100" >{this.state.progress}</progress>
                                </div>

                                <menu className="actions">
                                    <button className={"button button-stop"}
                                            onClick={this.handleStopClick} disabled={true}>
                                        <span>Detener</span>
                                    </button>

                                    <button className={"button button-start"}
                                            onClick={this.handleRunClick} disabled={ (this.state.counter > 0 || this.state.participants.length == 0) ? true : false}>
                                        <span>Iniciar</span>
                                    </button>
                                </menu>
                            </div>
                        </Tab>

                        <Tab tabName="Participantes" iconClassName={'lnr-users'} linkClassName={''}>
                            <div className="participants-view">
                                <dialog className="dialog" ref="dialogView">
                                    <div className="list-error">
                                        {
                                            this.state.errors.map((error, i) => {
                                                return (
                                                    <div key={i} className="list-error-item">{error}</div>
                                                )
                                            })
                                        }
                                    </div>
                                </dialog>

                                <form className="form-view form-participant" onSubmit={ this.handleAddSubmit }>
                                    <div className="form-view-row">
                                        <input className="form-control"
                                               type="text"
                                               placeholder="Escribir nombre e.g. Daniel"
                                               value={this.state.newName}
                                               onChange={this.handleAddChange}/>

                                        <button type="submit" className="button">Agregar</button>
                                    </div>
                                </form>

                                <ul className="participant-list">
                                    {
                                        (() => {

                                            let view = null;

                                            if (this.state.participants.length > 0) {
                                                view = this.state.participants.map((participant) => {
                                                    return (
                                                        <ParticipantItem key={participant.id} participant={participant}></ParticipantItem>
                                                    )
                                                })
                                            } else {
                                                view = (
                                                    <div>
                                                        <div className="nothing-to-show">No hay elementos que mostrar.</div>
                                                    </div>
                                                )
                                            }

                                            return view;
                                        })()
                                    }
                                </ul>
                            </div>
                        </Tab>

                        <Tab tabName="Marcador" iconClassName={'lnr-chart-bars'} linkClassName={''}>
                            <div className="score-view">
                                <ul className="participant-list">
                                    {
                                        (() => {
                                            let view = null;

                                            if (this.state.participants.length > 0) {
                                                view = this.state.participants.map((participant) => {
                                                    return (
                                                        <li key={participant.id} className="participant-list-item participant-list-item-score">
                                                            <div className="view-read">
                                                                <span className="lnr lnr-participant"></span>
                                                                <label className="label">
                                                                    {participant.firstname}
                                                                    <span className="small">
                                                                        {
                                                                            ((participant) => {
                                                                                let r = '';

                                                                                if (participant.xp > 0) {
                                                                                    r = moment(participant.updated_at, "YYYYMMDD").fromNow();
                                                                                }

                                                                                return r;
                                                                            })(participant)
                                                                        }
                                                                    </span>
                                                                </label>
                                                                <span className="xp">{participant.xp}</span>
                                                            </div>
                                                        </li>
                                                    )
                                                })
                                            } else {
                                                view = (
                                                    <div>
                                                        <div className="nothing-to-show">No hay elementos que mostrar.</div>
                                                    </div>
                                                )
                                            }

                                            return view;
                                        })()
                                    }
                                </ul>
                            </div>
                        </Tab>

                    </Tabs>
                </main>

                <dialog className="loading" ref="loading">
                    <svg viewBox="0 0 32 32" width="32" height="32">
                        <circle id="spinner" cx="16" cy="16" r="14" fill="none"></circle>
                    </svg>
                    <div className="loading-text">Cargando...</div>
                </dialog>
            </div>
        )
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<MainView speed="150" times="50" title="Random App"/>, document.querySelector('#app'));
}