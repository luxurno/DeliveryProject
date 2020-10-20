import React from 'react';

export class DriverNameFilter {
    getDriverId(name: String) {
        let id = name.split(".");
        return id[0];
    }

    getDriverName(name: String) {
        let id = name.split(".");
        return id[1];
    }
}
