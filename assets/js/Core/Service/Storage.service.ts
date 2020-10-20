export class StorageService {
    currentUserId$ = 1;

    getCurrentUserId(): number {
        return this.currentUserId$;
    }

    setCurrentUserId(currentUserId: number): void {
        this.currentUserId$ = currentUserId;
    }
}
