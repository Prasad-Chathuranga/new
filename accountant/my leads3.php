 <?php 
session_start();
if (!isset($_SESSION["id"])) {
 echo "<script>window.location.href='login.php'</script>";
}
$id = $_SESSION["id"];
require_once("include/head.php") ?>
  <body>
    <!-- Header navbar-->
    <?php require_once("include/navbar.php") ?>
    <!-- main -->
    <main>
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-2 order-lg-0 order-2">
            <div class="card">
              <div class="cardTextTop">
                You have <span>12 credits</span> available for use
              </div>
              <div>
                <a href="" class="btn creditsBtn">Buy Credits</a>
              </div>
              <hr />
              <div class="contact">
                <div class="contactText">Your contact</div>
                <div class="contactPerson">
                  <div>
                    <img src="./img/person.png" alt="" class="img-fluid" />
                  </div>
                  <div>
                    <div class="fontSmall">Meertens,<br />Marco</div>
                    <div class="fontSmall textColor">043-2003090</div>
                    <div class="fontSmall textColor">Email</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="goldBgColor">
              <h6>Meld u alvast aan voor onze partnerdag op 17 mei</h6>
              <p>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                Expedita sunt nesciunt a!
              </p>
            </div>
            <div class="card p0">
              <div class="paddingAll">
                <div>
                  <img
                    src="./img/finance-team.png"
                    class="img-fluid financeLogo"
                    alt=""
                  />
                </div>
                <div class="cardText">
                  Look for reinforcement for your office?
                </div>
                <div>
                  <a href="" class="textBottom">We can help you</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-10 order-lg-0 order-1">
            <div class="mijnLeads">
              <h2 class="leadsHeading fontize">
                Handy company from IJmuiden is looking for an office to work
                with
              </h2>
              <ul class="nav nav-tabs navTabs" id="myTab" role="tablist">
                <li class="nav-item navItem" role="presentation">
                  <button
                    class="nav-link tabsBtn"
                    id="one-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#one"
                    type="button"
                    role="tab"
                  >
                    Details
                  </button>
                </li>
                <li class="nav-item navItem" role="presentation">
                  <button
                    class="nav-link active tabsBtn"
                    id="one-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#two"
                    type="button"
                    role="tab"
                  >
                    Company
                  </button>
                </li>
                <li class="nav-item navItem" role="presentation">
                  <button
                    class="nav-link tabsBtn"
                    id="one-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#three"
                    type="button"
                    role="tab"
                  >
                    Contacts
                  </button>
                </li>
                <li class="nav-item navItem" role="presentation">
                  <button
                    class="nav-link tabsBtn"
                    id="one-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#four"
                    type="button"
                    role="tab"
                  >
                    Feedback
                  </button>
                </li>
              </ul>
              <div class="tab-content mb-5" id="myTabContent">
                <div class="tab-pane fade" id="one" role="tabpanel">
                  <h1>Details</h1>
                </div>
                <div class="tab-pane fade show active" id="two" role="tabpanel">
                  <div class="row borderBottom">
                    <div class="col-6">
                      <input
                        type="email"
                        class="form-control"
                        placeholder="E-mail"
                      />
                    </div>
                    <div class="col-6">
                      <div class="fontSize emailText">
                        rodriguezsolutions@ziggo.ni
                      </div>
                    </div>
                  </div>
                  <div class="row borderBottom">
                    <div class="col-6">
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Phone"
                      />
                    </div>
                    <div class="col-6">
                      <div class="fontSize">0636114259</div>
                    </div>
                  </div>
                  <div class="row borderBottom">
                    <div class="col-6">
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Address"
                      />
                    </div>
                    <div class="col-6">
                      <div class="fontSize">Zandhaver 16, IJmuiden 1974 VH</div>
                    </div>
                  </div>
                  <div class="row borderBottom">
                    <div class="col-6">
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Website"
                      />
                    </div>
                  </div>
                  <div class="row borderBottom">
                    <div class="col-6">
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Business type"
                      />
                    </div>
                    <div class="col-6">
                      <div class="fontSize">Proprietorship</div>
                    </div>
                  </div>
                  <div class="row borderBottom">
                    <div class="col-6">
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Sector"
                      />
                    </div>
                    <div class="col-6">
                      <div class="fontSize">Accountant</div>
                    </div>
                  </div>
                  <div class="row borderBottom">
                    <div class="col-6">
                      <input
                        type="text"
                        class="form-control"
                        placeholder="More industries"
                      />
                    </div>
                    <div class="col-6">
                      <div class="fontSize">
                        Accountant <br />
                        Bookkeeper
                      </div>
                    </div>
                  </div>
                  <div class="row borderBottom">
                    <div class="col-6">
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Company Name"
                      />
                    </div>
                    <div class="col-6">
                      <div class="fontSize">Rodriguez Solutions</div>
                    </div>
                  </div>
                  <div class="row borderBottom">
                    <div class="col-6">
                      <input
                        type="text"
                        class="form-control"
                        placeholder="VAT"
                      />
                    </div>
                    <div class="col-6">
                      <div class="fontSize">73626457</div>
                    </div>
                  </div>
                  <div class="row borderBottom">
                    <div class="col-6">
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Industry"
                      />
                    </div>
                  </div>
                  <div class="row align-items-center">
                    <div class="col-6">
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Annual sales"
                      />
                    </div>
                    <div class="col-6">
                      <div class="fontSize">45K</div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="three" role="tabpanel">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>alternate phone number</th>
                          <th>Contact by email</th>
                          <th>Contact by phone</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Rodriguez Perez, Donaldo</td>
                          <td>rodriguezsolutions@ziggo.ni</td>
                          <td>0636114259</td>
                          <td><i class="fa-solid fa-arrow-up-long"></i></td>
                          <td><i class="fa-solid fa-check"></i></td>
                          <td><i class="fa-solid fa-check"></i></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="tab-pane fade" id="four" role="tabpanel">
                  <h1>Feedback</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1">
      <div class="modal-dialog modalDialog">
        <div class="modal-content modalContent">
          <div class="modal-header modalHeader">
            <h5 class="modal-title modalTitle" id="exampleModalLabel">
              popup terugbetalingsverzoek
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
            ></button>
          </div>
          <div class="modal-body">
            <h6 class="modalBodyTopText">
              Terugbetalingsverzoek voor Klusbedrijf uit IJmuiden zoekt een
              kantoor om mee samen te werken
            </h6>
            <div class="alertBox">
              <p>
                <span
                  ><i
                    class="fa-solid fa-circle-exclamation faCircleExclamation"
                  ></i
                ></span>
                Weet u zeker dat u een terugbetalingsverzoek will indienen?
              </p>
            </div>
            <div class="loremBox">
              <p class="mb">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Corrupti eum ab veniam, iure repellendus quidem, dolores dolorem
                facilis necessitatibus quisquam aut, aliquam at nostrum laborum
                amet. Nihil vitae nesciunt nam rem minima odit laborum
                quibusdam? Neque delectus facilis consectetur? Harum a quis ad
                iure magnam!
              </p>
              <p class="mb">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Id
                tempore sit ut temporibus earum provident, quaerat nobis odio
                maxime quia similique, voluptates vitae voluptate consequatur!
              </p>
              <p class="mb">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Blanditiis, dolores totam iure iste, dolorum a minus accusantium
                adipisci aspernatur fuga vero aliquid eius libero. Laudantium
                ipsum tempore delectus earum doloremque soluta voluptate
                tenetur? Delectus enim, doloribus quidem, dolores quia,
                provident consequuntur possimus sint praesentium maiores at
                dignissimos autem quas perspiciatis.
              </p>
              <p class="mb">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima,
                magni veritatis! Natus reiciendis possimus illo dolorem autem
                totam ex debitis ut est, ullam alias veritatis eius molestiae
                aspernatur. Nihil quo velit qui perspiciatis obcaecati autem,
                veritatis rem ut esse! Odio quam accusantium qui ipsam quo.
              </p>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Eligendi dolor laborum, saepe porro laboriosam quia earum
                aperiam obcaecati placeat enim facilis sapiente ipsa maiores
                suscipit cumque ad magni. Labore illo voluptas dolorum saepe
                incidunt? Laborum laudantium numquam provident! Consequatur
                commodi aut vero, cupiditate facere excepturi.
              </p>
            </div>
            <div class="textareaBox">
              <label for=""
                >Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Cupiditate earum corporis quo nisi, temporibus culpa eum natus
                rem molestiae voluptates!</label
              >
              <textarea rows="8" class="form-control mb-3"></textarea>
              <label for=""
                >Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Quibusdam, modi?</label
              >
              <textarea rows="8" class="form-control mb-3"></textarea>
            </div>
            <div class="form-check form-switch formSwitch">
              <label for="">Offerte ingediend?</label>
              <div>
                <input
                  class="form-check-input formCheckInput"
                  type="checkbox"
                  role="switch"
                  id="flexSwitchCheckChecked"
                />
              </div>
            </div>
            <div>
              <button class="btn modalBtn" type="button">
                Terugbetalingsverzoek aanvragen
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
