import React, {Component} from 'react';
import axios from "axios";
import {AddressOddsBlock} from "../../Core/Block/AddressOdds.block";
import {AddressEvenBlock} from "../../Core/Block/AddressEven.block";
import {StorageService} from "../../Core/Service/Storage.service";
import NearByPerceptionBlock from "../../Core/Block/NearByPerception.block";
import {DriverOddsBlock} from "../../Core/Block/DriverOdds.block";
import {DriverEvenBlock} from "../../Core/Block/DriverEven.block";

export default class DriversNearByComponent extends Component {
    storageService$: StorageService = new StorageService();

    constructor(props) {
        super(props);

        this.state = {
            list: [],
            perception: null,
        };
    }

    async getListDrivers() {
        let userId = this.storageService$.getCurrentUserId();
        let perceptionId = this.props.perceptionId;

        new Promise((resolve, reject) => {
            setTimeout(async _ => resolve(
                await axios.get(process.env.APP_DOMAIN + '/api/near-by?userId=' + userId + '&perceptionId=' + perceptionId).then(res => {
                    const list = res.data;
                    this.setState({ list: list });
                    this.props.driversNearByListCallback(this.state);
                })
            ), 1000)
        });
    }

    componentDidUpdate(prevProps: Readonly<P>, prevState: Readonly<S>, snapshot: SS) {
        if (prevProps.perceptionId !== this.props.perceptionId) {
            this.getListDrivers().then(r => {

            });
        }
    }

    callbackPerception = (dataFromChild) => {
        this.setState({
            perception: dataFromChild.perception,
        });
        this.props.nearByPerceptionCallback(dataFromChild.perception);
    };

    render() {
        let list = this.state.list;
        let html = [];

        html.push(<NearByPerceptionBlock
            key={0}
            perceptionId={this.props.perceptionId}
            callbackPerception={this.callbackPerception}
        />);
        for( let i=0; i < list.length; i++) {
            list[i]['id'] = i;
            if (i%2 === 0) {
                html.push(<DriverOddsBlock key={i+1} data={list[i]} perceptionId={this.props.perceptionId}/>);
            } else {
                html.push(<DriverEvenBlock key={i+1} data={list[i]} perceptionId={this.props.perceptionId}/>);
            }
        }

        return(
            <div className={"lista-kierowcy-container"}>
                {html}
            </div>
        );
    }
}
