export declare const SENTRY_XHR_DATA_KEY = "__sentry_xhr_v2__";
export type InstrumentHandlerType = 'console' | 'dom' | 'fetch' | 'history' | 'sentry' | 'xhr' | 'error' | 'unhandledrejection';
export type InstrumentHandlerCallback = (data: any) => void;
/**
 * Add handler that will be called when given type of instrumentation triggers.
 * Use at your own risk, this might break without changelog notice, only used internally.
 * @hidden
 */
export declare function addInstrumentationHandler(type: InstrumentHandlerType, callback: InstrumentHandlerCallback): void;
/**
 * Reset all instrumentation handlers.
 * This can be used by tests to ensure we have a clean slate of instrumentation handlers.
 */
export declare function resetInstrumentationHandlers(): void;
/**
 * Parses the fetch arguments to find the used Http method and the url of the request
 */
export declare function parseFetchArgs(fetchArgs: unknown[]): {
    method: string;
    url: string;
};
/** JSDoc */
export declare function instrumentXHR(): void;
/** JSDoc */
export declare function instrumentDOM(): void;
//# sourceMappingURL=instrument.d.ts.map