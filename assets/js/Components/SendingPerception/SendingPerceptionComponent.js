import React, {Component} from 'react';
import SendingPerceptionForm from "./SendingPerception.form";
import {HeadersCustomBox} from "../../Core/Box/HeadersCustom.box";
import {HeadersEnum} from "../../Core/Text/Enum/Headers.enum";

export default class SendingPerceptionComponent extends Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <div className={"wysylanie-odbioru-container"}>
                <HeadersCustomBox headersText={HeadersEnum.SENDING_PERCEPTION} />

                <SendingPerceptionForm data={this.props.data} />
            </div>
        );
    }
}
