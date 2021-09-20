import React, {Component} from 'react';
import SendingPerceptionComponent from "../Components/SendingPerception/SendingPerceptionComponent";
import NearByComponent from "../Components/NearBy/NearBy.component";

export default class SendingPerception extends Component {
    constructor(props) {
        super(props);

        this.state = {
            id: null,
            name: "",
            showNearBy: false,
        };
    }

    moduleShowNearByCallback = (showNearBy) => {
        this.setState({
            id: showNearBy.id,
            showNearBy: showNearBy.showNearBy,
        });
    };

    render() {
        return(
            <div>
                <SendingPerceptionComponent
                    data={this.state}
                    moduleShowNearByCallback={this.moduleShowNearByCallback}
                />
                <NearByComponent
                    data={this.state}
                />
            </div>
        );
    }
}
