import React, {Component} from 'react';
import axios from "axios";
import OddsElement from "../DriverList/OddsElement/OddsElement";
import EvenElement from "../DriverList/EvenElement/EvenElement";
import {StorageService} from "../../Core/Service/Storage.service";

export default class DriversNearByComponent extends Component {
    storageService$: StorageService = new StorageService();

    constructor(props) {
        super(props);

        this.state = {
            name: "",
            list: [],
        };
    }

    async getListDrivers() {
        console.log('123');
        console.log(this.storageService$.getSendingPerceptionId());
        await axios.get(process.env.APP_DOMAIN + '/api/near-by/preview').then(res => {
            const list = res.data;
            this.setState({ list: list });
        });
    }

    componentDidMount() {
        this.getListDrivers().then(r => {
            this.props.driversNearByListCallback(this.state);
        });
    }

    render() {
        let list = this.state.list;
        let html = [];

        for( let i=0; i < list.length; i++) {
            list[i]['id'] = i;
            if (i%2 === 0) {
                html.push(<OddsElement key={i} data={list[i]} />);
            } else {
                html.push(<EvenElement key={i} data={list[i]} />);
            }
        }

        return(
            <div className={"lista-kierowcy-container"}>
                {html}
            </div>
        );
    }
}
