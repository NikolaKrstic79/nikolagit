<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Your Plan</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-plan {
            cursor: pointer;
            border: 2px solid transparent;
            transition: border-color 0.3s;
        }
        .card-plan:hover, .card-plan.active {
            border-color: red;
        }
        .plan-header {
            background-color: #f8f9fa;
            border-bottom: 2px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .plan-header.most-popular {
            background-color: gray;
            color: white;
        }
        .card-plan.active .plan-header.most-popular {
            background-color: red;
        }
        .titleback {
            background-color: red;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h3 class="text-center">STEP 2 OF 3</h3>
        <h1 class="text-center">Choose the plan that's right for you</h1>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card card-plan" data-plan="Premium">
                    <div class="plan-header most-popular">
                        <strong>Most Popular</strong>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title titleback display-6 text-center"><b>Premium</b></h5>
                        <ul class="list-unstyled">
                            <li>Monthly price:</li>
                            <li><b>EUR 9.99</b></li>
                            <hr>
                            <li>Video and sound quality:</li>
                            <li>Best</li>
                            <hr>
                            <li>Resolution:</li>
                            <li>4K (Ultra HD) + HDR</li>
                            <hr>
                            <li>Spatial audio (immersive sound):</li>
                            <li>Included</li>
                            <hr>
                            <li>Supported devices:</li>
                            <li>TV, computer, mobile phone, tablet</li>
                            <hr>
                            <li>Devices your household can watch at the same time:</li>
                            <li>4</li>
                            <hr>
                            <li>Download devices:</li>
                            <li>6</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-plan" data-plan="Standard">
                    <div class="plan-header"></div>
                    <div class="card-body">
                        <h5 class="card-title titleback display-6 text-center"><b>Standard</b></h5>
                        <ul class="list-unstyled">
                            <li>Monthly price:</li>
                            <li><b>EUR 7.99</b></li>
                            <hr>
                            <li>Video and sound quality:</li>
                            <li>Great</li>
                            <hr>
                            <li>Resolution:</li>
                            <li>1080p (Full HD)</li>
                            <hr>
                            <li>Supported devices:</li>
                            <li>TV, computer, mobile phone, tablet</li>
                            <hr>
                            <li>Devices your household can watch at the same time:</li>
                            <li>2</li>
                            <hr>
                            <li>Download devices:</li>
                            <li>2</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-plan" data-plan="Basic">
                    <div class="plan-header"></div>
                    <div class="card-body">
                        <h5 class="card-title titleback display-6 text-center"><b>Basic</b></h5>
                        <ul class="list-unstyled">
                            <li>Monthly price:</li>
                            <li><b>EUR 4.99</b></li>
                            <hr>
                            <li>Video and sound quality:</li>
                            <li>Good</li>
                            <hr>
                            <li>Resolution:</li>
                            <li>720p (HD)</li>
                            <hr>
                            <li>Supported devices:</li>
                            <li>TV, computer, mobile phone, tablet</li>
                            <hr>
                            <li>Devices your household can watch at the same time:</li>
                            <li>1</li>
                            <hr>
                            <li>Download devices:</li>
                            <li>1</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <button class="btn btn-danger btn-lg" id="nextButton" disabled>Next</button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirm Your Selection</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    You have selected the <span id="selectedPlan"></span> plan. Click "Confirm" to proceed.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="{{ route('payment') }}" class="btn btn-outline-danger">Confirm</a>
                </div>
            </div>
        </div>
    </div>

    <form id="planForm" action="{{ url('/payment') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="plan" id="planInput">
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const planCards = document.querySelectorAll('.card-plan');
            let selectedPlan = null;

            planCards.forEach(card => {
                card.addEventListener('click', function () {
                    planCards.forEach(c => c.classList.remove('active'));
                    card.classList.add('active');
                    selectedPlan = card.getAttribute('data-plan');
                    document.getElementById('nextButton').disabled = false;
                });
            });

            document.getElementById('nextButton').addEventListener('click', function () {
                document.getElementById('selectedPlan').innerText = selectedPlan;
                new bootstrap.Modal(document.getElementById('confirmationModal')).show();
            });

            document.getElementById('confirmSelection').addEventListener('click', function () {
                document.getElementById('planInput').value = selectedPlan;
                document.getElementById('planForm').submit();
            });
        });
    </script>
</body>
</html>
