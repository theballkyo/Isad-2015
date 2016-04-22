<?php
namespace App\Http\Controllers\Payment;

use App\Course;
use App\Enroll;
use App\Http\Controllers\Controller;
use App\Payment;
use App\PaymentComponents\GetEnrollWithLatestPayment;
use App\Http\Requests\PaymentRequest;
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
        $add_pay_btn = true;
        return view('course.index', compact('courses', 'add_pay_btn'));
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
        if (!$enroll->isWait()) {
            dd('Wait');
        }
        $course = $enroll->course;
        return view('payment.new', ['enroll_id' => $enroll->id, 'course' => $course]);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function savePayment(PaymentRequest $request)
    {
        $enroll = Enroll::where('id', $request->enroll_id)->owner($this->getUserId())->first();
        if ($enroll == null) {
            dd('no enroll');
            return '';
        }
        if (!$enroll->isWait()) {
            dd('Wait');
        }
        if(!in_array($request->file('img_file')->getMimeType(), ['image/jpeg', 'image/gif', 'image/png'])) {
            dd('FIle');
        }

        $payment = new Payment;

        $payment->bank = $request->bank;
        $payment->pay_time = $request->pay_time;
        $payment->img_name = $request->img_name;
        $payment->note = $request->note;

        $payment->setWait();
        $enroll->payments()->save($payment);

        $enroll->setCheck();
        $enroll->save();

        $request->file('img_file')->move("imgs/payments", $payment->id.'-');

        return redirect("/course/" . $enroll->course->id)->with('msg', 'pay_send');
    }
}
