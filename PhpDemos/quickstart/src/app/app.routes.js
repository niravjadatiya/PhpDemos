"use strict";
var router_1 = require('@angular/router');
var theMovieDb_component_1 = require('./theMovieDb.component');
var MoreInfo_component_1 = require('./MoreInfo.component');
exports.routes = [
    { path: '', redirectTo: 'TheMovieDb', pathMatch: 'full' },
    { path: 'TheMovieDb', component: theMovieDb_component_1.theMovieDbComponent },
    { path: 'MoreInfo/:id', component: MoreInfo_component_1.MoreInfo }
];
exports.appRoutingProviders = [];
exports.routing = router_1.RouterModule.forRoot(exports.routes);
//# sourceMappingURL=app.routes.js.map