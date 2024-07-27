const data = window._ckyGcm;
let setDefaultSetting = true;
const regionSettings = data.default_settings || [];
const waitForTime = data.wait_for_update;

window.dataLayer = window.dataLayer || [];
function gtag() {
    dataLayer.push(arguments);
}

function setConsentInitStates(consentData) {
    if (waitForTime > 0) consentData.wait_for_update = waitForTime;
    gtag("consent", "default", consentData );
}

gtag("set", "ads_data_redaction", !!data.ads_data_redaction);
gtag("set", "url_passthrough", !!data.url_passthrough);
gtag("set", "developer_id.dY2Q2ZW", true);

for (let index = 0; index < regionSettings.length; index++) {
    const regionSetting = regionSettings[index];
    const consentRegionData = {
        ad_storage: regionSetting.advertisement,
        analytics_storage: regionSetting.analytics,
        functionality_storage: regionSetting.functional,
        personalization_storage: regionSetting.functional,
        security_storage: regionSetting.necessary,
        ad_user_data: regionSetting.ad_user_data,
        ad_personalization: regionSetting.ad_personalization
    };
    const regionsToSetFor = regionSetting.regions
        .split(",")
        .map((region) => region.trim())
        .filter((region) => region);
    if (regionsToSetFor.length > 0 && regionsToSetFor[0].toLowerCase() !== "all")
        consentRegionData.region = regionsToSetFor;
    else setDefaultSetting = false;
    setConsentInitStates(consentRegionData);
}

if (setDefaultSetting) {
    setConsentInitStates({
      ad_storage: "denied",
      analytics_storage: "denied",
      functionality_storage: "denied",
      personalization_storage: "denied",
      security_storage: "granted",
      ad_user_data: "denied",
      ad_personalization: "denied"
    });
}