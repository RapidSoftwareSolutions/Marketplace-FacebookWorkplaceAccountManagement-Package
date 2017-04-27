[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/FacebookWorkplaceAccountManagement/functions?utm_source=RapidAPIGitHub_FacebookWorkplaceAccountManagementFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# FacebookWorkplaceAccountManagement Package
This set of Facebook Workplace API calls will allow you to build a custom connector to provision and deactivate your people who are stored on your user directory.
* Domain: [work.facebook.com](https://work.facebook.com/)
* Credentials: accessToken

## How to get credentials: 
1. In the Company Dashboard, open the Integrations tab.
2. Click on the Create App button.
3. Choose a relevant name and description for the app.
4. Choose the required permissions for the app, based on the integration functionality you require.
5. Copy and safely store the access token that's shown to you.

## FacebookWorkplaceAccountManagement.createAccountForPerson
When a new person joins your organization or is newly-granted access to Workplace, you must create an account for them

| Field      | Type       | Description
|------------|------------|----------
| accessToken| credentials| The api key obtained from Facebook Workplace
| scimId     | Number     | Your scim company id
| userName   | String     | Unique identifier for the user, used by the user to directly authenticate with the service provider. Must be unique.
| name       | String     | The components of the Users real name.
| active     | Boolean    | A Boolean value indicating whether a user is active. Set to true if the user is able to access Workplace and should receive email and mobile push notifications. Set to false to cause the user to be logged out and to prevent the user from receiving further emails or mobile push notifications.
| email      | String     | Primary user e-mail
| title      | String     | Title of the user, e.g., Vice President.
| nickName   | String     | The casual way to address the user in real life, e.g., Bob or Bobby instead of Robert. This attribute SHOULD NOT be used to represent a username.

## FacebookWorkplaceAccountManagement.updateUser
When any user attribute changes in your user directory, you must update the user's account in Workplace. This can either be done on event, when the underlying data changes, or in a batch, say every 3 hours.

| Field      | Type       | Description
|------------|------------|----------
| accessToken| credentials| The api key obtained from Facebook Workplace
| scimId     | Number     | Your scim company id
| userId     | Number     | Workplace id
| userName   | String     | Unique identifier for the user, used by the user to directly authenticate with the service provider. Must be unique.
| name       | String     | The components of the Users real name.
| email      | String     | Primary user e-mail
| active     | Boolean    | A Boolean value indicating whether a user is active. Set to true if the user is able to access Workplace and should receive email and mobile push notifications. Set to false to cause the user to be logged out and to prevent the user from receiving further emails or mobile push notifications.
| title      | String     | Title of the user, e.g., Vice President.
| nickName   | String     | The casual way to address the user in real life, e.g., Bob or Bobby instead of Robert. This attribute SHOULD NOT be used to represent a username.

## FacebookWorkplaceAccountManagement.getAllUsers
You can retrieve the information about your users

| Field      | Type       | Description
|------------|------------|----------
| accessToken| credentials| The api key obtained from Facebook Workplace
| scimId     | Number     | Your scim company id

## FacebookWorkplaceAccountManagement.deactivateUserAccount
When a person leaves your organization or should not longer have access to Workplace, you must deactivate their account

| Field      | Type       | Description
|------------|------------|----------
| accessToken| credentials| The api key obtained from Facebook Workplace
| scimId     | Number     | Your scim company id
| userId     | Number     | Workplace id
| userName   | String     | Unique identifier for the user, used by the user to directly authenticate with the service provider. Must be unique.
| name       | String     | The components of the Users real name.

## FacebookWorkplaceAccountManagement.deletingUserAccount
If a person's account has been created in error and that account has never been claimed by the user you can delete it

| Field      | Type       | Description
|------------|------------|----------
| accessToken| credentials| The api key obtained from Facebook Workplace
| scimId     | Number     | Your scim company id
| userId     | Number     | Workplace id

