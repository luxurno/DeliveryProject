import React, {Component} from 'react';
import SendingPerceptionForm from "./Form/SendingPerception.form";
import {HeadersCustomBox} from "../../Core/Box/HeadersCustom.box";
import {HeadersEnum} from "../../Core/Text/Enum/Headers.enum";

export default class SendingPerceptionComponent extends Component {
    constructor(props) {
        super(props);

        this.state = {
            id: null,
            showNearBy: false,
        };
    }

    showNearByCallback = (showNearBy) => {
        this.setState({
            id: showNearBy.id,
            showNearBy: showNearBy.showNearBy,
        });
        this.props.moduleShowNearByCallback(this.state);
    };

    render() {
        return (
            <div
                style={{display: this.state.showNearBy ? 'none' : 'block' }}
                className={"wysylanie-odbioru-container"}
            >
                <HeadersCustomBox headersText={HeadersEnum.SENDING_PERCEPTION} />

                <SendingPerceptionForm data={this.props.data} showNearByCallback={this.showNearByCallback}/>
            </div>
        );
    }
}
