import React, {Component} from 'react';
import {NameSlicer} from "../Slicer/Name.slicer";

export class DriverEvenBlock extends Component {
    nameSlicer$: NameSlicer = new NameSlicer();

    constructor(props) {
        super(props);
    }

    render() {
        return(
            <div className={"driver-block driver-block-even"}>
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
        );
    }
}
