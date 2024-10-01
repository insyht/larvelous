export * from './exports';
import { Integrations as CoreIntegrations } from '@sentry/core';
import * as BrowserIntegrations from './integrations';
declare const INTEGRATIONS: {
    GlobalHandlers: typeof BrowserIntegrations.GlobalHandlers;
    TryCatch: typeof BrowserIntegrations.TryCatch;
    Breadcrumbs: typeof BrowserIntegrations.Breadcrumbs;
    LinkedErrors: typeof BrowserIntegrations.LinkedErrors;
    HttpContext: typeof BrowserIntegrations.HttpContext;
    Dedupe: typeof BrowserIntegrations.Dedupe;
    FunctionToString: typeof CoreIntegrations.FunctionToString;
    InboundFilters: typeof CoreIntegrations.InboundFilters;
};
export { INTEGRATIONS as Integrations };
export { Replay } from '@sentry/replay';
export { ReplayEventType, ReplayEventWithTime, ReplayBreadcrumbFrame, ReplayBreadcrumbFrameEvent, ReplayOptionFrameEvent, ReplayFrame, ReplayFrameEvent, ReplaySpanFrame, ReplaySpanFrameEvent, } from '@sentry/replay';
export { BrowserTracing, defaultRequestInstrumentationOptions, instrumentOutgoingRequests, } from '@sentry-internal/tracing';
export { RequestInstrumentationOptions } from '@sentry-internal/tracing';
export { addTracingExtensions, setMeasurement, extractTraceparentData, getActiveTransaction, spanStatusfromHttpCode, trace, makeMultiplexedTransport, ModuleMetadata, } from '@sentry/core';
export { SpanStatusType } from '@sentry/core';
export { Span } from '@sentry/types';
export { makeBrowserOfflineTransport } from './transports/offline';
export { onProfilingStartRouteTransaction } from './profiling/hubextensions';
export { BrowserProfilingIntegration } from './profiling/integration';
//# sourceMappingURL=index.d.ts.map
