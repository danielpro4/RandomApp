import React from 'react';

class ParticipantItem extends React.Component {

    constructor(props) {
        super(props);

        this.handleChecked = this.handleChecked.bind(this);

        this.state = {
            isChecked: props.participant.active == 1 ? true : false,
        };
    }

    handleChecked(evt) {
        evt.stopPropagation();

        this.setState({
            isChecked: !this.state.isChecked,
        });
    }

    render() {

        return (
            <li className="participant-list-item">
                <div className="view-read">
                    <input className="uk-radio"
                       checked={this.state.isChecked}
                       type="checkbox"
                       onChange={this.handleChecked}
                    />
                    <span className="lnr lnr-participant"></span>
                    <label className="label">{this.props.participant.firstname}</label>
                    <button onClick={(evt) => {
                        this.handleRemoveClick(evt, this.props.participant.id)
                    }} className="destroy">
                        <span className="lnr lnr-trash"></span>
                    </button>
                </div>
            </li>
        );
    }
}

export default ParticipantItem;
