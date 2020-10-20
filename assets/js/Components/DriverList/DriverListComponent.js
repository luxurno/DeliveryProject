import React, {Component} from 'react';
import axios from 'axios';
import {AddressOddsBlock} from "../../Core/Block/AddressOdds.block";
import {AddressEvenBlock} from "../../Core/Block/AddressEven.block";

export default class DriverListComponent extends Component {
    constructor(props) {
        super(props);

        this.state = {
            name: "",
            list: [],
        };
    }

    async getListDrivers() {
        await axios.get(process.env.APP_DOMAIN + '/api/route/preview').then(res => {
            const list = res.data;
            this.setState({ list: list });
        });
    }

    componentDidMount() {
        this.getListDrivers().then(r => {
            this.props.callbackFromParent(this.state);
        });
    }

    render() {
        let list = this.state.list;
        let html = [];

        for( let i=0; i < list.length; i++) {
            list[i]['id'] = i;
            if (i%2 === 0) {
                html.push(<AddressOddsBlock key={i} data={list[i]} />);
            } else {
                html.push(<AddressEvenBlock key={i} data={list[i]} />);
            }
        }

        return(
            <div className={"lista-kierowcy-container"}>
                {html}
            </div>
        );
    }
}
