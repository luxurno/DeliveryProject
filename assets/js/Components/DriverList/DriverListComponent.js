import React, {Component} from 'react';
import axios from 'axios';
import {AddressOddsBlock} from "../../Core/Block/AddressOdds.block";
import {AddressEvenBlock} from "../../Core/Block/AddressEven.block";
import {DriverNameFilter} from "../../Core/Filter/DriverName.filter";
import {StorageService} from "../../Core/Service/Storage.service";

export default class DriverListComponent extends Component {
    driverNameFilter$: DriverNameFilter = new DriverNameFilter();
    storageService$: StorageService = new StorageService();

    constructor(props) {
        super(props);

        this.state = {
            name: "",
            list: [],
        };
    }

    componentDidUpdate(prevProps: Readonly<P>, prevState: Readonly<S>, snapshot: SS) {
        if (prevProps.data.name !== this.props.data.name) {
            let id = this.driverNameFilter$.getDriverId(this.props.data.name);
            let userId = this.storageService$.getCurrentUserId();

            axios.get(process.env.APP_DOMAIN + '/api/route/' + id + '?userId=' + userId).then(res => {
                const list = res.data;
                this.setState({
                    list: list,
                })
            });
        }
    }

    render() {
        let { name } = this.props.data;
        let { list } = this.state;
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
