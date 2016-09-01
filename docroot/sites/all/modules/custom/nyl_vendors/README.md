VENDORS API
The Vendors API features endpoints related to the searching and references of specific vendors for NYL games.

ACCESS:
    All endpoints of the Vendors API are read-only. Users should not be permitted to modify any aspect of the vendor records.

DEFINITIONS
| Endpoint     | Methods | Description |
| -------------|---------|-------------------------------------------------------------------------------------------------|
| /vendors     | GET     | Returns an array of Vendor objects matching search criteria provided in the query string of the request. |
| /vendor/{id} | GET     | Obtains a single Vendor object matching the provided ID. |


Criteria:
    near: A geospatial coordinate pair passed as x,y
    Ex: api.sample.com/v1/vendors?near=-74.0059,40.7128

    games: A comma-separated list of game IDs the vendor sells
    Ex: api.sample.com/v1/vendors?games=1,5,9,8

    categories: A comma separated list of category IDs to limit the vendors to
    Ex: api.sample.com/v1/vendors?categories=9,15,25,2

////////////////////////////////////////////////////////////////////////////

RESPONSE
ALL server responses should be delivered as valid JSON following this basic response structure
{
“code”: 200,
“status”: “SUCCESS”,
“message”: “Player successfully fetched.”, “data”: { ... },
“errors”: []
}

| Field   | Required? | Format  | Description                                                                          |
| --------|-----------|---------|--------------------------------------------------------------------------------------|
| code    | Y         | Integer | HTTP Status Code: 200 – Success, 4xx – Authentication Errors, 5xx – Service Errors   |
| status  | Y         | String  | A descriptive word describing the outcome of the request. (e.g. “Success”, “Processing”, “Error”, “Warning”) |
| message | Y         | String  | A descriptive, short message describing the outcome of the request. |
| data    | Y         | Mixed   | An Array of Objects or single Object representing the requested resource |
| errors  | N         | Array   | An Array of ErrorObjects that describes any specific process or user errors (warnings or fatal) encountered during the request. These should specifically be limited to errors in which the user or application needs to take action or should be informed.


////////////////////////////////////////////////////////////////////////////


ERROR OBJECT
An object describing an error event during request processing...

| Field       | Data Type | Description                                                                                |
| ------------|-----------|--------------------------------------------------------------------------------------------|
| errorID     | String    | A unique identifier for the error                                                          |
| errorCode   | String    | A code that identifies the unique type of error event that occurred.                       |
| message     | String    | A textual description of the error that is safe for the user to see.                       |
| notes       | String    | Textual debug information that can help a technical resource track down and resolve an issue |
| displayable | Binary    | A flag indicating whether or not the error should be displayed to the user                 |
| level       | Integer   | An indicator of the severity of the error. Should be a valid ErrorLevel constant.          |
| errorTime   | Double    | A unix timestamp when the error occurred.                                                  |


////////////////////////////////////////////////////////////////////////////


VENDOR OBJECT
An object representing an individual vendor who sells New York Lottery game tickets...

| Field          | Data Type | Description                                                                             |
| ---------------|-----------|-----------------------------------------------------------------------------------------|
| vendorID       | String    | An unique identifier for the vendor                                                     |
| name           | String    | The vendor’s unique name                                                                |
| type           | Integer   | An integer representing the type of vendor it is, etc. (see VendorType constants)       |
| longitude      | Float     | The longitudinal value of the vendor’s location                                         |
| latitude       | Float     | The latitudinal value of the vendor’s location                                          |
| street_address | String    | The physical street address of the vendor                                               |
| city           | String    | The name of the city where the vendor is located                                        |
| zipCode        | String    | The zip code in which the vendor is located                                             |
| games          | Array     | An array of games IDs for the games offered for sale at the particular vendor           |
| category       | Integer   | The category that the vendor belongs. (see VendorCategory constants)                    |
| hot            | Binary    | A binary value indicating if the vendor having recently sold a high winning ticket      |
| description    | String    | A textual description of the vendor/location                                            |

VENDOR TYPE CONSTANTS
| Name                  | int | Description                                                                            |
| ----------------------|-----|----------------------------------------------------------------------------------------|
| Full Service Terminal | 0   | A vendor who operates a full service terminal, such as those usually found in convenience stores |
| Self Service Machine  | 1   | A vendor that is a standalone, self-serve machine                                      |
| Lottery On Board      | 2   | A vendor that operates “Lottery On Board” terminals                                    |
| TBD                   | TBD | TBD                                                                                    |


VENDOR CATEGORY CONSTANTS
| Name              | int | Description                                                                                |
| ------------------|-----|--------------------------------------------------------------------------------------------|
| Other             | 0   | A generic category for vendors who don’t fit in a more specific category                   |
| Grocery Store     | 1   | A vendor who sales are primarily retail/wholesale food                                     |
| Convenience Store | 2   | A vendor who is a convenience store                                                        |
| Bars              | 3   | A vendor who is primarily a bar, pub, or other drinking establishment                      |
| TBD               | TBD | TBD                                                                                        |

