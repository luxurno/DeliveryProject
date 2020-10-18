import React from 'react';

export class OnKeyPressService {
    constructor() {

    }

    isKeyPressed(event: KeyboardEvent, key: String): boolean {
        return event.key === key;
    }
}
