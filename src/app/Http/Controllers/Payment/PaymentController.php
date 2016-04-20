<?php
namespace App\Http\Controllers\Payment;

use App\Course;
use App\Enroll;
use App\Http\Controllers\Controller;
use App\Payment;
use App\PaymentComponents\GetEnrollWithLatestPayment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use GetEnrollWithLatestPayment;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $courses = Course::whereHas('enroll', function ($query) {
            $query->owner($this->getUserId())->waitForPayment();
        })->get();

        return view('course.index', ['courses' => $courses]);
    }

    public function getPayment($enroll_id)
    {
        $enroll = $this->getEnrollWithLatestPayment($enroll_id);
        $course = $enroll->course;
        return view('payment.form', ['enroll_id' => $enroll->id, 'course' => $course]);
    }

    /**
     * @param $enroll_id
     * @return mixed
     */
    public function newPayment($enroll_id)
    {
        $enroll = $this->getEnrollWithLatestPayment($enroll_id, $this->getUserId());
        if ($enroll == null) {
            return "!?";
        }
        $course = $enroll->course;
        return view('payment.new', ['enroll_id' => $enroll->id, 'course' => $course]);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function savePayment(Request $request)
    {
        $enroll = Enroll::where('id', $request->id)->owner($this->getUserId())->first();
        if ($enroll == null) {
            // Redirect
            return '';
        }

        $img_name = $request->img;

        $payment = new Payment;

        $payment->bank = $request->bank;
        $payment->pay_time = $request->pay_time;
        $payment->img_name = $img_name;
        $payment->note = $request->note;

        $payment->setWait();
        $enroll->payments()->save($payment);

        return view('payment.success');
    }
}
