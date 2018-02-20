<?php


function replaceFromHaystack($haystack,$needle,$replace)
{
    $pos = strpos($haystack, $needle);
    $newstring = $haystack;
    if ($pos !== false) {
        $newstring = substr_replace($haystack, $replace, $pos, strlen($needle));
    }
    return $newstring;
}


function IsNullOrEmptyString($str)
{
    return (!isset($str) || trim($str) === '');
}

function getDBLink()
{
    require 'credential.php';
    $link = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    return $link;
}

function getUserInfo($username)
{
    $sql = "SELECT username, type, firstname, lastname, companyname, sex, email, phone, profile FROM users WHERE username = '" . $username . "'";
    $link = getDBLink();
    $return_arr = [];
    if ($result = mysqli_query($link, $sql)) {
        while ($row = mysqli_fetch_row($result)) {
            $return_arr = [
                "username" => $row[0],
                "type" => $row[1],
                "firstname" => $row[2],
                "lastname" => $row[3],
                "companyname" => $row[4],
                "sex" => $row[5],
                "email" => $row[6],
                "phone" => $row[7],
                "profile" => $row[8],
            ];
        }
        mysqli_free_result($result);
        mysqli_close($link);
    } else {
        echo "Error during DB call getuserinfo()" . var_dump($sql);
        return null;
    }
    return $return_arr;
}

function getDepartmentInfo()
{
    $sql = "SELECT dId, departmentname FROM department";
    $link = getDBLink();
    $departmentHtml = "";

    if ($stmt = mysqli_prepare($link, $sql)) {

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            // Check number of rows in the result set
            if (mysqli_num_rows($result) > 0) {
                // Fetch result rows as an associative array
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $departmentHtml = $departmentHtml . "<option value = " . $row["dId"] . "> " . $row["departmentname"] . "</option>";
                }
            }
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    return $departmentHtml;
}


function getResourceDropdown()
{

    $resourceHtml = '<div class="dropdown">
                      <button class="btn btn-default dropdown-toggle btn-primary" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        View Our Inventory
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="computer.php">Computer</a></li>
                        <li><a href="microphone.php">Microphone</a></li>
                        <li><a href="projector.php">Projector</a></li>
                        <li><a href="room.php">Room</a></li>
                      </ul>
                    </div>';
    return $resourceHtml;
}


function getComputerDetails($query)
{

    $computerHtmlUpper = '<table class="table top20x">
          <thead>
            <tr>
              <th>#</th>
              <th>Type</th>
              <th>Manufacturer</th>
              <th>Model</th>
              <th>OS</th>
              <th>Serial No</th>
              <th>Description</th>
            </tr>
          </thead><tbody>';
    $computerHtmlMid = '';
    $computerHtmlBotom = '
          </tbody>
        </table>';


    $sql = $query;
    $link = getDBLink();

    if ($stmt = mysqli_prepare($link, $sql)) {

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            // Check number of rows in the result set
            if (mysqli_num_rows($result) > 0) {
                // Fetch result rows as an associative array
                $i = 1;
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $computerHtmlMid = $computerHtmlMid . '<tr>
                          <th scope="row">' . $i . '</th>
                          <td>' . $row["type"] . '</td>
                          <td>' . $row["manufacturer"] . '</td>
                          <td>' . $row["model"] . '</td>
                          <td>' . $row["os"] . '</td>
                          <td>' . $row["serialnum"] . '</td>
                          <td>' . $row["description"] . '</td>
                        </tr>';
                    $i++;
                }
            }
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    return $computerHtmlUpper . $computerHtmlMid . $computerHtmlBotom;
}


function getMicrophoneDetail($query)
{

    $computerHtmlUpper = '<table class="table top20x">
          <thead>
            <tr>
              <th>#</th>
              <th>Type</th>
              <th>Manufacturer</th>
              <th>Model</th>
              <th>Serial No</th>
              <th>Description</th>
            </tr>
          </thead><tbody>';
    $computerHtmlMid = '';
    $computerHtmlBotom = '
          </tbody>
        </table>';


    $sql = $query;
    $link = getDBLink();

    if ($stmt = mysqli_prepare($link, $sql)) {

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            // Check number of rows in the result set
            if (mysqli_num_rows($result) > 0) {
                // Fetch result rows as an associative array
                $i = 1;
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $computerHtmlMid = $computerHtmlMid . '<tr>
                          <th scope="row">' . $i . '</th>
                          <td>' . $row["type"] . '</td>
                          <td>' . $row["manufacturer"] . '</td>
                          <td>' . $row["model"] . '</td>
                          <td>' . $row["serialnum"] . '</td>
                          <td>' . $row["description"] . '</td>
                        </tr>';
                    $i++;
                }
            }
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }


    return $computerHtmlUpper . $computerHtmlMid . $computerHtmlBotom;
}

function getProjectorDetail($query)
{

    $computerHtmlUpper = '<table class="table top20x">
          <thead>
            <tr>
              <th>#</th>
              <th>Type</th>
              <th>Manufacturer</th>
              <th>Model</th>
              <th>Serial No</th>
              <th>Description</th>
            </tr>
          </thead><tbody>';
    $computerHtmlMid = '';
    $computerHtmlBotom = '
          </tbody>
        </table>';


    $sql = $query;
    $link = getDBLink();

    if ($stmt = mysqli_prepare($link, $sql)) {

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            // Check number of rows in the result set
            if (mysqli_num_rows($result) > 0) {
                // Fetch result rows as an associative array
                $i = 1;
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $computerHtmlMid = $computerHtmlMid . '<tr>
                          <th scope="row">' . $i . '</th>
                          <td>' . $row["type"] . '</td>
                          <td>' . $row["manufacturer"] . '</td>
                          <td>' . $row["model"] . '</td>
                          <td>' . $row["serialnum"] . '</td>
                          <td>' . $row["description"] . '</td>
                        </tr>';
                    $i++;
                }
            }
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }


    return $computerHtmlUpper . $computerHtmlMid . $computerHtmlBotom;
}

function getRoomDetail($query)
{

    $computerHtmlUpper = '<table class="table top20x">
          <thead>
            <tr>
              <th>#</th>
              <th>Type</th>
              <th>Name</th>
              <th>Room No</th>
              <th>Capacity</th>
              <th>Description</th>
            </tr>
          </thead><tbody>';
    $computerHtmlMid = '';
    $computerHtmlBotom = '
          </tbody>
        </table>';


    $sql = $query;

    $link = getDBLink();

    if ($stmt = mysqli_prepare($link, $sql)) {

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            // Check number of rows in the result set
            if (mysqli_num_rows($result) > 0) {
                // Fetch result rows as an associative array
                $i = 1;
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $computerHtmlMid = $computerHtmlMid . '<tr>
                          <th scope="row">' . $i . '</th>
                          <td>' . $row["type"] . '</td>
                          <td>' . $row["name"] . '</td>
                          <td>' . $row["roomnum"] . '</td>
                          <td>' . $row["capacity"] . '</td>
                          <td>' . $row["description"] . '</td>
                        </tr>';
                    $i++;
                }
            }
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }


    return $computerHtmlUpper . $computerHtmlMid . $computerHtmlBotom;
}


function getAvailableResource($type, $startdate, $enddate)
{

    $computerHtmlUpper = '<table class="table top20x">
          <thead>
            <tr>
              <th>#</th>
              <th>Type</th>
              <th>Manufacturer</th>
              <th>Model</th>
              <th>OS</th>
              <th>Serial No</th>
              <th>Description</th>
            </tr>
          </thead><tbody>';
    $computerHtmlMid = '';
    $computerHtmlBotom = '
          </tbody>
        </table>';


    $sql = "select r.type, c.manufacturer, c.model, c.os, c. serialnum, r.description from resources r inner join computer c
    on c.rID = r.rId";
    $link = getDBLink();

    if ($stmt = mysqli_prepare($link, $sql)) {

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            // Check number of rows in the result set
            if (mysqli_num_rows($result) > 0) {
                // Fetch result rows as an associative array
                $i = 1;
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $computerHtmlMid = $computerHtmlMid . '<tr>
                          <th scope="row">' . $i . '</th>
                          <td>' . $row["type"] . '</td>
                          <td>' . $row["manufacturer"] . '</td>
                          <td>' . $row["model"] . '</td>
                          <td>' . $row["os"] . '</td>
                          <td>' . $row["serialnum"] . '</td>
                          <td>' . $row["description"] . '</td>
                        </tr>';
                    $i++;
                }
            }
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    return $computerHtmlUpper . $computerHtmlMid . $computerHtmlBotom;
}












function getInsertDetail($userdetail)
{
    $insertFirstName = " firstname = '" . $userdetail['firstname'] . "', ";
    $insertLastName = " lastname = '" . $userdetail['lastname'] . "', ";
    $insertcompanyname = " companyname = '" . $userdetail['companyname'] . "', ";
    $insertsex = " sex = '" . $userdetail['sex'] . "', ";
    $insertemail = " email = '" . $userdetail['email'] . "', ";
    $insertphone = " phone = '" . $userdetail['phone'] . "', ";
    $insert = $insertFirstName . $insertLastName . $insertcompanyname . $insertsex . $insertemail . $insertphone;

    $insertdId = " dId = '" . $userdetail['department'] . "', ";
    if (!IsNullOrEmptyString($userdetail['department'])) {
        $insert = $insert . $insertdId;
    }
    $insert = substr($insert, 0, -2);
    return $insert . ' ';
}

function updateUser($userdetail, $username)
{


    $insertDetail = getInsertDetail($userdetail);

    $sql = "UPDATE users SET " . $insertDetail . "  where username = '" . $username . "'";
    $link = getDBLink();
    if ($result = mysqli_query($link, $sql)) {
        mysqli_close($link);
        return true;
    } else {
        echo "Error during DB call updateUser()" . var_dump($sql);
        return false;
    }
}

function updateProfilePic($imagelocation, $username)
{
    $sql = "UPDATE users SET profile = '" . $imagelocation . "'  where username = '" . $username . "'";
    $link = getDBLink();
    if ($result = mysqli_query($link, $sql)) {
        mysqli_close($link);
        return true;
    } else {
        echo "Error during DB call updateProfilePic()" . var_dump($sql);
        return false;
    }
}

function getProfilePic($username)
{
    $sql = "select profile from users where username = '" . $username . "'";
    $link = getDBLink();
    $profile = "";
    if ($result = mysqli_query($link, $sql)) {
        while ($row = mysqli_fetch_row($result)) {
            $profile = $row[0];
        }
        mysqli_free_result($result);
        mysqli_close($link);
    } else {
        echo "Error during DB call getProfilePic()" . var_dump($sql);
        return null;
    }
    return $profile;
}

?>