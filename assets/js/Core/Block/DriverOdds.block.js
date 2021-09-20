import React, {Component} from 'react';
import axios from 'axios';
import {NameSlicer} from "../Slicer/Name.slicer";

export class DriverOddsBlock extends Component {
    nameSlicer$: NameSlicer = new NameSlicer();

    constructor(props) {
        super(props);

        this.handleDriverOrder = this.handleDriverOrder.bind(this);
    }

    handleDriverOrder(event) {
        let driverId = this.props.data.id;
        let perceptionId = this.props.perceptionId;

        axios
            .put(
                process.env.APP_DOMAIN + '/api/perception/' + perceptionId,
                {
                    driverId: driverId + 1,
                },
                { withCredentials: true }
            )
            .then(response => {
                if (response.status === 204) {
                    window.location = '/route-lookup'
                }
            })
            .catch(error => {

            });
        event.preventDefault();
    }

    render() {
        return (
            <div>
                <div className={"driver-block driver-block-odds"}>
                    <div className={'wrapper'}>
                        <div className={'item-all item-a'}>{this.props.data.id + 1}.</div>
                        <div className={'item-all item-b'}>
                            <img src={this.props.data.image} alt={this.props.data.name} />
                            <span>{this.nameSlicer$.getFirstName(this.props.data.name)}</span>
                        </div>
                        <div className={'item-all item-c'}><span>{this.nameSlicer$.getLastName(this.props.data.name)}</span></div>
                        <div className={'item-all item-d'}><span>ADR:&nbsp;{this.props.data.adr}</span></div>
                        <div className={'item-all item-e'}><span>Wysokość:&nbsp;{this.props.data.height}</span></div>
                        <div className={'item-all item-f'}><span>Długość:&nbsp;{this.props.data.width}</span></div>
                        <div className={'item-all item-g'}><span>Ładowność:&nbsp;{this.props.data.capacity}</span></div>
                    </div>
                </div>
                <div className={'text-center driver-customize-button'}>
                    <button
                        type={"button"}
                        className={"btn btn-primary"}
                        onClick={this.handleDriverOrder}
                    >Zleć</button>
                </div>
            </div>
        );
    }
}
