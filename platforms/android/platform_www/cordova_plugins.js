cordova.define('cordova/plugin_list', function(require, exports, module) {
module.exports = [
  {
    "id": "cordova-sms-plugin.Sms",
    "file": "plugins/cordova-sms-plugin/www/sms.js",
    "pluginId": "cordova-sms-plugin",
    "clobbers": [
      "window.sms"
    ]
  }
];
module.exports.metadata = 
// TOP OF METADATA
{
  "cordova-plugin-whitelist": "1.3.3",
  "cordova-sms-plugin": "0.1.11"
};
// BOTTOM OF METADATA
});