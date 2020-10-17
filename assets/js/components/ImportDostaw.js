import React, {Component} from 'react';
import ImportDostawModule from "./Modules/ImportDostaw/ImportDostawModule";

class ImportDostaw extends Component {
    constructor() {
        super();

        this.state = {
            title: "Importuj dostawy",
            button: "Importuj",
            name: "",
            showConfig: false,
        };
    }

    driverNameCallback = (dataFromChild) => {
        this.setState({
            name: dataFromChild.name,
            showConfig: dataFromChild.showConfig,
        });
        // TODO Remove bug with missing one action (letter)
    };

    render() {
        return (
            <div>
                <ImportDostawModule data={this.state} callbackFromParent={this.driverNameCallback}/>

            </div>
        );
    }
}
export default ImportDostaw;