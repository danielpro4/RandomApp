import React, {Component} from 'react';

const Tab = (props) => {
    return (
        <a className={`menu-item ${props.linkClassName} ${props.isActive ? 'active' : ''}`}
           onClick={(event) => {
               event.preventDefault();
               props.onClick(props.tabIndex);
           }}>
            <i className={`lnr ${props.iconClassName}`}/>
            <span>{props.tabName}</span>
        </a>
    )
};


export default Tab;